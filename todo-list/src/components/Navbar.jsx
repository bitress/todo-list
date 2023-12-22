import React from 'react';
import LogoutButton from "./Auth/LogoutButton.jsx";
import {handleLogout} from "../services/authService.jsx";
import {useNavigate} from "react-router-dom";

function Navbar({isLoggedIn}) {

    const navigate = useNavigate();

    const handleLogoutClick = () => {
        handleLogout(navigate);
    };


    return (
        <>
            <nav className="navbar navbar-expand-lg bg-light">
                <div className="container-fluid">
                    <a className="navbar-brand" href="#">To-Do List</a>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul className="navbar-nav">
                            {isLoggedIn ? (
                                // If logged in
                                <>
                                    <li className="nav-item">
                                        <a className="nav-link active" aria-current="page" href="#">My Todos</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" href="#">Settings</a>
                                    </li>
                                    <li className="nav-item">
                                        <LogoutButton handleLogout={handleLogoutClick} />
                                    </li>
                                </>
                            ) : (
                                // If not logged in
                                <>
                                    <li className="nav-item">
                                        <a className="nav-link" href="#">Login</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" href="#">Register</a>
                                    </li>
                                </>
                            )}
                        </ul>
                    </div>
                </div>
            </nav>
        </>
    );
}

export default Navbar;
