import React, {Component} from "react";
import Admin from "./Admin";

export default class AdminApp extends Component {
    constructor(props) {
        super(props);

        this.state = {
            mobileSidebar: false,
        };

        this.handleHamburgerClick = this.handleHamburgerClick.bind(this);
    }

    handleHamburgerClick() {
        this.setState({
            mobileSidebar: !this.state.mobileSidebar
        });
    }

    render() {
        return (
            <Admin
                {...this.state}
                onHamburgerClick={this.handleHamburgerClick}
            />
        );
    }
}