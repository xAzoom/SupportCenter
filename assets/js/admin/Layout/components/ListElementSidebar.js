import React, {Component} from "react";

export default class ListElementSidebar extends Component {
    constructor(props) {
        super(props);

        this.state = {
            extended: false
        };

        this.handleClick = this.handleClick.bind(this);
    }


    handleClick(e) {
        e.preventDefault();

        const {subcategories} = this.props;
        const haveSubCategories = subcategories && subcategories.length > 0;

        if (haveSubCategories) {
            this.setState({
                extended: !this.state.extended
            });
        }
    }

    render() {
        const {name, icon, subcategories} = this.props;
        const {extended} = this.state;
        const haveSubCategories = subcategories && subcategories.length > 0;

        let classLiElement = (haveSubCategories) ? 'nav-parent' : '';
        classLiElement += (extended) ? ' nav-expanded' : '';

        return (
            <li className={classLiElement}>
                <a href="" onClick={(e) => (this.handleClick(e))}>
                    <i className={"fa nav-icon " + icon} aria-hidden="true"></i> {name}
                </a>

                {(haveSubCategories) &&
                <ul className="nav-children">
                    {subcategories.map(subcategory => {
                        return <li key={subcategory}><a href="#">{subcategory}</a></li>
                    })}
                </ul>
                }
            </li>
        );
    }
}