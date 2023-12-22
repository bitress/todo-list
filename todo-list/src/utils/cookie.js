
export const setCookie = (name, value, expiresInHours) => {
    const expirationDate = new Date(Date.now() + expiresInHours * 60 * 60 * 1000).toUTCString();
    document.cookie = `${name}=${value}; expires=${expirationDate}; path=/`;
};

export const getCookie = (name) => {
    const cookies = document.cookie.split(';');
    for (const cookie of cookies) {
        const [cookieName, cookieValue] = cookie.trim().split('=');
        if (cookieName === name) {
            return cookieValue;
        }
    }
    return null;
};

export const deleteCookie = (name) => {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    return true;
};
