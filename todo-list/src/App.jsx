
import React, { useState } from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import HomePage from './pages/HomePage';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';

function App() {

    const [isLoggedIn, setLoggedIn] = useState(false);

    return (
        <Router>
            <Routes>
                <Route
                    path="/login"
                    element={isLoggedIn ? <Navigate to="/" /> : <LoginPage setLoggedIn={setLoggedIn} />}
                />
                <Route
                    path="/register"
                    element={isLoggedIn ? <Navigate to="/" /> : <RegisterPage setLoggedIn={setLoggedIn} />}
                />
                <Route
                    path="/"
                    element={isLoggedIn ? <HomePage /> : <Navigate to="/login" />}
                />
            </Routes>
        </Router>
    );
}

export default App;
