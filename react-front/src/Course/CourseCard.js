import React from 'react';
import './CourseCard.css';
import Utils from '../Utils/Utils';
import Author from '../Account/Author';
import { Link } from 'react-router-dom';

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
        let date = new Date(course.createdDate);
        date = Utils.formatDate(date);

        return <div className="paddingCourseCard">
            <div className="courseCard">
                <div className="flexSpaced">
                    <div className="flexed">
                        { /* The style is for the dynamic computed color */ }
                        <div className="roundedTag" style={ { backgroundColor: Utils.proceduralThemeColor(course.themeId) } }>
                            <span>{ course.theme }</span>
                        </div>
                        { /* The style is for the dynamic computed difficulty color */ }
                        <div className="roundedTag" style={ { backgroundColor: Utils.difficultyColor(course.difficulty) } }>
                            <span>Difficulté - { course.difficulty }</span>
                        </div>
                    </div>
                    <div>
                        <Author name={ course.author } />
                        <span> Créé le <time dateTime={ course.createdDate }>{ date }</time></span>
                    </div>
                </div>
                <Link to={ `/course/${course.courseId}` }>
                    <h3>{ course.name }</h3>
                    <div className="flexed">
                    </div>
                    <span>{ course.description }</span>
                </Link>
            </div>
        </div>
    }
}
