import React from 'react';

export default class Accounts extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.state = {
            
        }
    }

    // ---- METHODS ----

    async componentDidMount(prev)
    {
		//fetch("http://localhost:8000/api/accounts/1").then(response => response.json()).then(data => this.setState({ test: data.nickname }, () => console.log(this.state.test)));
	}

    render()
    {
        return <p>Accounts</p>
    }
}