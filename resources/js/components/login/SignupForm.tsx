import React, { useEffect, useState } from "react";

export const SignupForm = () => {

    useEffect(() => {
        console.log('This is where we would pull our google sign on stuff.')
	});
    return (
        <div>
            <div className="auth-form">
                <label >Email</label>
                <input />
                <label>Password</label>
                <input type="password" />
            </div>
        </div>
    );
};