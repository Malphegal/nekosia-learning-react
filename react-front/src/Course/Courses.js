import React from 'react';
import CourseCard from './CourseCard';
import PageNav from '../Utils/PageNav';
import Cookies from 'universal-cookie';

export default class Courses extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        
        const params = this.props.match.params;
        let a = new URLSearchParams(window.location.search);
        console.log(window.location.search, a);
        this.state = {
            courses: undefined,
            totalAmount: undefined,
            filter_name: '',
            currentPage: (params.page !== undefined ? params.page : 1),
        }
        
        this.defaultAPI_URL = "http://localhost:8000/api/courses/";
        this.currentPageURL = "http://localhost:3000/courses";
        
        const cookies = new Cookies();

        let cookie_pageSize = cookies.get('pageSize');
        if (cookie_pageSize === undefined)
        {
            cookies.set('pageSize', 10, { path: '/', maxAge: 31556952 });
            cookie_pageSize = 10;
        }
        this.pageSize = cookie_pageSize;
    }

    // ---- METHODS ----
    
    // ---- Forms

    filterForm()
    {
        return <div>
            <label>Nom 
                <input type="text" value={ this.state.filter_name } onChange={ (e) => this.setState({ filter_name: e.target.value }) } onKeyDown={ (e) => { if (e.key === 'Enter') this.submitFilterForm(); } } />
            </label>
            <input type="button" value="Envoyer" onClick={ this.submitFilterForm.bind(this) } />
        </div>
    }

    submitFilterForm()
    {
        let filters = '';
        let filter_name = this.state.filter_name;
        if (filter_name.trim() !== '')
            filters += '?name=' + encodeURIComponent(filter_name);

        this.fetchAPI(filters);
    }

    // ---- Children functions

    // TODO: Problème avec la nav des pages ! Changer le lien de ->>> localhost:3000/courses/[1-...] ->>>> localhost:3000/courses?page=...
    // TODO: Check https://stackoverflow.com/questions/10970078/modifying-a-query-string-without-reloading-the-page
    onClickPage(page)
    {
        if (page !== this.state.currentPage)
        {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + page;
            window.history.pushState({path:newurl},'',newurl);
            this.setState({ currentPage: page }, () => this.submitFilterForm());
        }

        //console.log(page, this.state.currentPage);
    }

    // ---- API

    fetchAPI(filters = '')
    {
        const currentPage = this.state.currentPage;
        const pageSize = this.pageSize;
        const defaultAPI_URL = this.defaultAPI_URL;
        console.log(`${defaultAPI_URL}${currentPage}/${pageSize}${filters}`);
		fetch(`${defaultAPI_URL}${currentPage}/${pageSize}${filters}`).then(response => response.json()).then(data => this.setState({ courses: data.courses, totalAmount: data.totalAmount }));
    }

    // ---- Render

    componentDidMount(prev)
    {
        this.submitFilterForm();
	}

    render()
    {
        const courses = this.state.courses;

        const currentPage = this.state.currentPage;
        const pageSize = this.pageSize;
        const totalAmount = this.state.totalAmount;
        const currentPageURL = this.currentPageURL;

        if (courses !== undefined)
        {
            return <div id="mainContent">
                { this.filterForm() }
                <div className="cardContainer">
                    { courses.map((c, index) => <CourseCard key={ index } course={ c } />) }
                </div>
                <div>
                    <PageNav current={ currentPage } pageSize={ pageSize } totalAmount={ totalAmount } currentPageURL={ currentPageURL } onClick={ this.onClickPage.bind(this) } />
                </div>
            </div>
        }
        return null;
    }
}