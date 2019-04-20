import React, {Component} from "react";

import "./Header.css";

export default class Header extends Component {

    handleHamburgerClick(e) {
        e.preventDefault();

        const { onHamburgerClick } = this.props;
        onHamburgerClick();
    }

    render() {
        return (
            <header className="header">
                <div className="header-left"><h3><i className="fab fa-envira nav-icon" aria-hidden="true"></i> Admin Panel</h3></div>
                <div className="header-right">
                    <a href="" className="btn hamburger" id="hamburger" onClick={(e) => (this.handleHamburgerClick(e))}><i className="fas fa-bars"></i></a>
                </div>
            </header>
        )
    }

}