import React from 'react';
import './PageNav.css';

export default class PageNav extends React.Component{
    
    // ---- CONSTRUCTORS ----

    constructor(props)
    {
        super(props);
        this.tagIndex = 0;
        
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
     * @returns Returns a new <span> tag.
     */
    createLink(page, isCurrent = undefined)
    {
        return <span className="pageNavElement" id={ isCurrent ? isCurrent : "" } onClick={ (e) => this.props.onClick(e.target.innerHTML) } key={ this.tagIndex++ }>{ page }</span>
    }

    /**
     *  A function to get previous indexes of the current page index.
     *
     * @returns Returns <span> elements.
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
     * @returns Returns <span> elements.
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
            { this.previousPages(current, pageSize) }
            { this.createLink(current, this.notInRange ? "" : "currentPageIndex") }
            { this.nextPages(current, pageSize, totalAmount) }
        </span>
    }
}