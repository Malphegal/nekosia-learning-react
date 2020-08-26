import React from 'react';
import CourseCard from './CourseCard';
import PageAmount from '../Utils/PageAmount';

export default class Courses extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.state = {
            courses: undefined,
            totalAmount: undefined,
            defaultAPI_URL: "http://localhost:8000/api/courses/", // TODO: à sortir du state
            currentPageURL: "http://localhost:3000/", // TODO: à sortir du state
        }

        const params = this.props.match.params;
        this.currentPage = params.currentPage;
        this.pageSize = params.pageSize;
    }

    // ---- METHODS ----

    async componentDidMount(prev)
    {
        const currentPage = this.currentPage;
        const pageSize = this.pageSize;
        const defaultAPI_URL = this.state.defaultAPI_URL;
		fetch(`${defaultAPI_URL}${currentPage}/${pageSize}`).then(response => response.json()).then(data => this.setState({ courses: data.courses, totalAmount: data.totalAmount }));
	}

    render()
    {
        const courses = this.state.courses;

        const currentPage = this.currentPage;
        const pageSize = this.pageSize;
        const totalAmount = this.state.totalAmount;
        const currentPageURL = this.state.currentPageURL;

        if (courses !== undefined)
        {
            return <div id="mainContent">
                <div className="cardContainer">
                    { courses.map((c, index) => <CourseCard key={ index } course={ c } />) }
                </div>
                <div>
                    <PageAmount current={ currentPage } pageSize={ pageSize } totalAmount={ totalAmount } currentPageURL={ currentPageURL } />
                </div>
            </div>
        }
        return null;
    }
}