// components/Auth/LogoutButton.jsx
import React from 'react';

const LogoutButton = ({ handleLogout }) => {
    return (
        <>
            <a className="nav-link" onClick={handleLogout}>
                Logout
            </a>
        </>
    );
};

export default LogoutButton;
