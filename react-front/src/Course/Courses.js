import React from 'react';
import CourseCard from './CourseCard';
import PageAmount from '../Utils/PageAmount';
import Cookies from 'universal-cookie';

export default class Courses extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.state = {
            courses: undefined,
            totalAmount: undefined,
        }
        
        this.defaultAPI_URL = "http://localhost:8000/api/courses/";
        this.currentPageURL = "http://localhost:3000/courses/";
        
        const cookies = new Cookies();

        let cookie_pageSize = cookies.get('pageSize');
        if (cookie_pageSize === undefined)
        {
            cookies.set('pageSize', 10, { path: '/', maxAge: 31556952 });
            cookie_pageSize = 10;
        }
        this.pageSize = cookie_pageSize;

        const params = this.props.match.params;
        this.currentPage = (params.page !== undefined ? params.page : 1);
    }

    // ---- METHODS ----

    async componentDidMount(prev)
    {
        const currentPage = this.currentPage;
        const pageSize = this.pageSize;
        const defaultAPI_URL = this.defaultAPI_URL;
		fetch(`${defaultAPI_URL}${currentPage}/${pageSize}`).then(response => response.json()).then(data => this.setState({ courses: data.courses, totalAmount: data.totalAmount }));
	}

    render()
    {
        const courses = this.state.courses;

        const currentPage = this.currentPage;
        const pageSize = this.pageSize;
        const totalAmount = this.state.totalAmount;
        const currentPageURL = this.currentPageURL;

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