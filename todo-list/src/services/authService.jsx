// authServices.js
import {API_URL} from "../config.js";
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
            notyf.success(responseData.message);

            setTimeout(function () {
                setLoggedIn(true);
                navigate('/');
            }, 3000);
        } else {
            notyf.error(responseData.message);
        }
    } catch (error) {
        console.error('Fetch request failed:', error);
    }
};
