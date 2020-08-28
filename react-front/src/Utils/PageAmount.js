import React from 'react';
import './PageAmount.css';

export default class PageAmount extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.tagIndex = 0;
        
        this.currentPageURL = undefined;
        this.current = undefined;
        this.pageSize = undefined;
        this.totalAmount = undefined;

        this.notInRange = false;
        this.maxIndexesRange = 3;
    }
    
    // ---- METHODS ----

    /**
     * Creates a <a> tag linked to a page.
     *
     * @param {number} page The page link.
     * @param {string|undefined} [isCurrent=undefined] The ID tag prop.
     * @returns Returns a new <a> tag.
     */
    createLink(page, isCurrent = undefined)
    {
        return <a className="pageLink" id={ isCurrent ? isCurrent : "" } href={ `${this.currentPageURL}${page}` } key={ this.tagIndex++ }>{ page }</a>
    }

    /**
     *  A function to get previous indexes of the current page index.
     *
     * @param {number} currentPageURL The current base URL.
     * @param {number} current The current page.
     * @param {number} pageSize The page size.
     * @returns Returns <a> elements.
     */
    previousPages()
    {
        let res = [];
        for (let i = Math.max(1, this.current - this.maxIndexesRange); i < this.current; i++)
            res.push(this.createLink(i));
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
    nextPages()
    {
        let res = [];
        for (let i = parseInt(this.current, 10) + 1; i <= Math.min(this.current + this.maxIndexesRange, Math.ceil(this.totalAmount / this.pageSize)); i++)
            res.push(this.createLink(i));
        return res;
    }

    render()
    {
        this.aIndex = 0;
        const currentPageURL = this.currentPageURL = this.props.currentPageURL;
        let current = this.current = parseInt(this.props.current);
        const pageSize = this.pageSize = parseInt(this.props.pageSize);
        const totalAmount = this.totalAmount = parseInt(this.props.totalAmount);

        if (current > Math.ceil(this.totalAmount / this.pageSize))
        {
            current = this.current = Math.ceil(this.totalAmount / this.pageSize);
            this.notInRange = true;
        }

        const pageWord = totalAmount > pageSize ? "Pages" : "Page";
        return <span>
            { pageWord } :
            { this.previousPages(currentPageURL, current, pageSize) }
            { this.createLink(current, this.notInRange ? "" : "currentPageIndex") }
            { this.nextPages(currentPageURL, current, pageSize, totalAmount) }
        </span>
    }
}