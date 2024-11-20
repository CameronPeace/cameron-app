import React, { useState } from "react";
import { LoginForm } from './login/LoginForm';
import { SignupForm } from "./login/SignupForm";

export const Login = () => {

    const [loginForm, showLoginForm] = useState(false);
    const [signupForm, showSignupForm] = useState(false);
    const [buttonOptions, ShowButtonOptions] = useState(true);

    function toggleLogin() {
        console.log('toggle!');
        showLoginForm(true);
        ShowButtonOptions(false);
    }

    function toggleSignup() {
        showSignupForm(true);
        ShowButtonOptions(false);
    }

    return (
        <div className="login">
            <h1>Welcome</h1>
            <div>
                <h4>Please select a entry option below</h4>
                <div className="login-options">
                    {loginForm ? <LoginForm/> : buttonOptions ?  <button onClick={() => toggleLogin()} className="btn btn-blue">Login</button> : null}
                    {signupForm ? <SignupForm/> : buttonOptions ? <button onClick={() => toggleSignup()} className="btn btn-blue">New User? Sign up</button> : null}
                </div>
            </div>
        </div>
    );
};