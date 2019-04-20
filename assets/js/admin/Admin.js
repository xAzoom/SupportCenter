import React from "react";

import "bootstrap/dist/css/bootstrap.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

import Header from "./Layout/Header";
import Sidebar from "./Layout/Sidebar";

import "./Admin.css";

export default function Admin(props) {
    const {onHamburgerClick, mobileSidebar} = props;

    return (
        <section id="wrapper">
            <Header
                onHamburgerClick={onHamburgerClick}
            />
            <Sidebar
                mobileSidebar={mobileSidebar}
            />
            <main className="main">

            </main>
        </section>
    )
}