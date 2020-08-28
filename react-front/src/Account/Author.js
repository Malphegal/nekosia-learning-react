import React from 'react';
import './Author.css';
import { Link } from 'react-router-dom';

export default class Author extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.state = {
        }
    }

    // ---- METHODS ----

    render()
    {
        const name = this.props.name;
        return <span className="author"><Link to={ `/profil/${name.toLowerCase()}` }>{ name }</Link></span>
    }
}
