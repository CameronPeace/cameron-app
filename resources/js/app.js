import './bootstrap.js';
import React from "react";
import { createRoot } from 'react-dom/client';
import { App } from "./components/App.tsx";
const domNode = document.getElementById('root');
createRoot(domNode).render(<App/>);
