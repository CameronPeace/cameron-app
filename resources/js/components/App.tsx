import React, { useState } from "react";

export interface IUser {
    id: number;
    name: string;
    age: number;
}
export const App = () => {
    const [users, setUsers] = useState <IUser[]>([
        {
            id: 1,
            name: "Bijaya",
            age: 25,
        },
        {
            id: 2,
            name: "Ram",
            age: 25,
        },
    ]);

    return (
        <div>
            <h1>Users list</h1>
            <ul>
                {users.map((user: IUser) => {
                    return (
                        <li key={user.id}>
                            {user.name} is {user.age} years old
                        </li>
                    );
                })}
            </ul>
        </div>
    );
};