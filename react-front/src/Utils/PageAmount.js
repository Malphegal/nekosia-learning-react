import React from 'react';
import './PageAmount.css';

export default class PageAmount extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.aIndex = 0;

        this.maxIndexesRange = 3;
    }
    
    // ---- METHODS ----

    /**
     *  A function to get previous indexes of the current page index.
     *
     * @param {number} currentPageURL The current base URL.
     * @param {number} current The current page.
     * @param {number} pageSize The page size.
     * @returns Returns <a> elements.
     */
    previousPages(currentPageURL, current, pageSize)
    {
        let res = [];
        for (let i = Math.max(1, current - this.maxIndexesRange); i < current; i++)
            res.push(<a href={ `${currentPageURL}${i}/${pageSize}` } key={ this.aIndex++ }>{ i }</a>);
        return res;
    }

    /**
     *  A function to get next indexes of the current page index
     * 
     * @param {number} currentPageURL The current base URL.
     * @param {number} current The current page.
     * @param {number} pageSize The page size.
     * @param {number} totalAmount The total amount of items.
     * @returns Returns <a> elements.
     */
    nextPages(currentPageURL, current, pageSize, totalAmount)
    {
        let res = [];
        for (let i = parseInt(current, 10) + 1; i <= Math.min(current + this.maxIndexesRange, Math.ceil(totalAmount / pageSize)); i++)
            res.push(<a href={ `${currentPageURL}${i}/${pageSize}` } key={ this.aIndex++ }>{ i }</a>);
        return res;
    }

    render()
    {
        this.aIndex = 0;
        const currentPageURL = this.props.currentPageURL;
        const current = this.props.current;
        const pageSize = this.props.pageSize;
        const totalAmount = this.props.totalAmount;

        const pageWord = totalAmount > pageSize ? "Pages" : "Page";
        return <span>
            { pageWord } :
            { this.previousPages(currentPageURL, current, pageSize) }
            <a id="currentPageIndex" href={ `${currentPageURL}${current}/${pageSize}` } key={ this.aIndex++ }>{ current }</a>
            { this.nextPages(currentPageURL, current, pageSize, totalAmount) }
        </span>
    }
}

//currentPageIndex