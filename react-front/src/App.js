import React from 'react';
import './App.css';
import Courses from './Course/Courses.js'
import { BrowserRouter as Router, Route/*, Link */ } from 'react-router-dom';

function App() {
    return <Router>
        <div>
            { /*
            <ul>
                <li><Link to="/">Home</Link></li>
                <li><Link to="/about">About</Link></li>
                <li><Link to="/topics">Topics</Link></li>
            </ul>
            */ }
            <header>
                <p>a</p>
            </header>

            <Route path="/:currentPage/:pageSize" component={ Courses }/>
            { /* <Route path="/about" component={About}/> */ }
            { /* <Route path="/topics" component={Topics}/> */ }
        </div>
    </Router>
}

export default App;
