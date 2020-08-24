    import React from 'react';

export default class CourseCard extends React.Component{
    
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
        const course = this.props.course;
        console.log(course);
        let date = new Date(course.createdDate);
        date = ("0" + date.getDate()).slice(-2) + " / " + ("0" + date.getMonth()).slice(-2) + " / " + (date.getYear() + 1900);
        return <div>
            <h3>{ course.name }</h3>
            <time dateTime={ course.createdDate }>{ date }</time>
        </div>
    }
}