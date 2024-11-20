import React, { useEffect, useState } from "react";

export const LoginForm = () => {

    useEffect(() => {
        console.log('This is where we would pull our google sign on stuff.')
    });

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');


    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        console.log('Submitted:', email);
    };

    return (
        <div>
            <form onSubmit={(e) => handleSubmit(e)}>
                <div className="auth-form">
                    <label>
                        Email:
                    </label>
                        <input type="text" value={email} onChange={(e) => setEmail(e.target.value)} />
                    <label>
                        Password:
                    </label>
                        <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
                    <button className="btn btn-blue" type="submit">Submit</button>
                </div>
            </form>
        </div>
    );
};