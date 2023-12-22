import React, { useState } from 'react';
import axios from "axios";

function LoginPage() {

    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const handleUsernameChange = (e) => {
        setUsername(e.target.value);
    };

    const handlePasswordChange = (e) => {
        setPassword(e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const data = JSON.stringify({
            "action": "login",
            "username": username,
            "password": password
        });

        const config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: 'http://localhost/todo-list/',
            headers: {
                'Content-Type': 'application/json'
            },
            data: data
        };

        axios.request(config)
            .then((response) => {
                console.log(JSON.stringify(response.data));
            })
            .catch((error) => {
                console.log(error);
            });
    };


    return (
        <>
            <section className="h-100">
                <div className="container h-100">
                    <div className="row justify-content-sm-center h-100">
                        <div className="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                            <div className="text-center my-5">
                                <img
                                    src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg"
                                    alt="logo"
                                    width="100"
                                />
                            </div>
                            <div className="card shadow-lg">
                                <div className="card-body p-5">
                                    <h1 className="fs-4 card-title fw-bold mb-4">Login</h1>
                                    <form
                                        method="POST"
                                        className="needs-validation"
                                        noValidate=""
                                        autoComplete="off"
                                        onSubmit={handleSubmit}
                                    >
                                        <div className="mb-3">
                                            <label className="mb-2 text-muted" htmlFor="username">
                                                E-Mail Address
                                            </label>
                                            <input
                                                id="username"
                                                type="text"
                                                className="form-control"
                                                name="username"
                                                value={username}
                                                onChange={handleUsernameChange}
                                                required
                                                autoFocus
                                            />
                                            <div className="invalid-feedback">Email is invalid</div>
                                        </div>

                                        <div className="mb-3">
                                            <div className="mb-2 w-100">
                                                <label className="text-muted" htmlFor="password">
                                                    Password
                                                </label>
                                                <a href="forgot.html" className="float-end">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                            <input
                                                id="password"
                                                type="password"
                                                className="form-control"
                                                name="password"
                                                value={password}
                                                onChange={handlePasswordChange}
                                                required
                                            />
                                            <div className="invalid-feedback">Password is required</div>
                                        </div>

                                        <div className="d-flex align-items-center">
                                            <div className="form-check">
                                                <input
                                                    type="checkbox"
                                                    name="remember"
                                                    id="remember"
                                                    className="form-check-input"
                                                />
                                                <label htmlFor="remember" className="form-check-label">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <button type="submit" className="btn btn-primary ms-auto">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div className="card-footer py-3 border-0">
                                    <div className="text-center">
                                        Don't have an account?{' '}
                                        <a href="register.html" className="text-dark">
                                            Create One
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div className="text-center mt-5 text-muted">
                                Copyright &copy; 2017-2021 &mdash; Your Company
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
}

export default LoginPage;
