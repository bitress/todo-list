import React, { useEffect, useState } from 'react';
import {jwtDecode} from 'jwt-decode';
import { getCookie } from '../utils/cookie.js';
import TodoList from "../components/Todo/TodoList.jsx";

function HomePage() {
    const [decodedData, setDecodedData] = useState(null);

    useEffect(() => {
        const decodeJWTFromCookie = () => {
            try {
                // Retrieve the JWT from the cookie
                const jwtToken = getCookie('jwt');

                if (!jwtToken) {
                    console.error('JWT not found in the cookie');
                    window.location.href = '/login'
                    return;
                }

                // Decode the JWT using jwt-decode library
                const decoded = jwtDecode(jwtToken);

                console.log('Decoded JWT:', decoded);

                // Check token expiration
                if (decoded.exp && decoded.exp < Date.now() / 1000) {
                    console.log('JWT has expired');
                    // Redirect to the login page when the token has expired
                    window.location.href = '/login'
                    return;
                }

                setDecodedData(decoded);
            } catch (error) {
                console.error('Error decoding JWT or handling cookie:', error);
            }
        };

        decodeJWTFromCookie();
    }, []);




    return (
        <>

            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        {decodedData && (
                            <div className="mt-4 p-5 bg-secondary text-white rounded">
                                <h3>Hello, {decodedData.data.username}</h3>
                            </div>
                        )}
                    </div>

                    <div className="col-md-12">
                        <TodoList></TodoList>
                    </div>
                </div>
            </div>


        </>
    );
}

export default HomePage;
