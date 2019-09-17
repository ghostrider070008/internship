import React from 'react';
import ReactDom from 'react-dom';
import './app/styles/style.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';

import Layout from './app/layouts/layout';
import MainPage from './app/components/Main';
import Catalog from './app/components/Catalog';
import About from './app/components/About';
import SignIn from './app/components/SignIn';
import Basket from './app/components/Basket';
import PageNotFound from './app/components/PageNotFound';

ReactDom.render(<Router history={browserHistory}>
    <Route path="/" component={Layout}>
        <IndexRoute component={MainPage}/>
        <Route path="catalog" component={Catalog}/>
        <Route path="about" component={About}/>
        <Route path="signin" component={SignIn}/>
        <Route path="basket" component={Basket}/>
        <Route path="*" component={PageNotFound}/>
    </Route>
</Router>, document.querySelector('#root'));