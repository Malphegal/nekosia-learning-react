import React from 'react';
import CourseCard from './CourseCard';

export default class Courses extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.state = {
            courses: undefined,
        }
    }

    // ---- METHODS ----

    async componentDidMount(prev)
    {
		fetch("http://localhost:8000/api/courses/1/4").then(response => response.json()).then(data => this.setState({ courses: data }));
	}

    render()
    {
        const courses = this.state.courses;
        if (courses !== undefined)
        {
            return <div>{ courses.map((c, index) => <CourseCard key={ index } course={ c } />) }</div>
        }
        return null
    }
}