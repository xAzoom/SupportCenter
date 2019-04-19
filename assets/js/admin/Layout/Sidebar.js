import React, {Component} from "react";
import ListElementSidebar from "./components/ListElementSidebar";

import './Sidebar.css';

export default class Sidebar extends Component {
    render() {
        const {mobileSidebar} = this.props;

        return (
            <aside id="sidebar-left" className={"sidebar-left" + ((mobileSidebar) ? " expanded" : "")}>
                <nav className="menu">
                    <div className="well user-panel">
                        <img src="build/static/img_avatar.png" alt="Avatar" className="avatar"/>
                        <h2>Administrator</h2>
                    </div>

                    <ul className="nav nav-main">
                        <ListElementSidebar name={"Dashboard"} icon={"fa-home"}/>
                        <ListElementSidebar name={"Tickets"} icon={"fa-copy"}
                                            subcategories={['All tickets', 'Payment']}
                        />
                    </ul>
                </nav>
            </aside>
        );
    }
}