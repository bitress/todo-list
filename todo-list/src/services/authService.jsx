// authServices.js
import {API_URL} from "../config.js";
import {deleteCookie} from "../utils/cookie.js";

export const login = async (username, password, setLoggedIn, navigate, setCookie, notyf) => {
    try {
        const data = {
            action: 'login',
            username: username,
            password: password
        };

        const response = await fetch(API_URL, {
            method: 'POST',
            body: JSON.stringify(data)
        });

        const responseData = await response.json();


        if (responseData.success) {
            setCookie('jwt', responseData.jwt, 1);
            setCookie('isLoggedIn', true, 1);
            notyf.success(responseData.message);

            setTimeout(function () {
                setLoggedIn(true);
                navigate('/');
            }, 1200);
        } else {
            notyf.error(responseData.message);
        }
    } catch (error) {
        console.error('Fetch request failed:', error);
    }
};


export const handleLogout = (navigate) => {
    // Clear the JWT token from the cookie
    const deleted = deleteCookie('jwt');
    deleteCookie('isLoggedIn');

    if (deleted) {
        // Navigate to the login page
        navigate('/login');
    } else {
        console.error('Failed to delete JWT cookie');
    }
};
