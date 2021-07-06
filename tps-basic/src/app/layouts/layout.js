import React, { Component } from 'react';
import { Link } from 'react-router';

class Layout extends Component {
    render () {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-4">
                    <ul>
                        <li><Link to="/">Главная</Link></li>
                        <li><Link to="/catalog">Каталог</Link></li>
                        <li><Link to="/about">О нас</Link></li>
                        <li><Link to="/signIn">Войти</Link></li>
                        <li><Link to="/basket">Корзина</Link></li>
                        <li><Link to="/404">404</Link></li>
                    </ul>                      
                    </div>
                    <div className="col-8">
                        {this.props.children}
                    </div>
                </div>
            </div>
        )
    }
}

export default Layout