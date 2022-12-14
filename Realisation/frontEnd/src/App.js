import logo from './logo.svg';
import './App.css';

import React from 'react';
import {BrowserRouter,Routes,Route} from 'react-router-dom';
import Dashbord from './components/DashbordPage/Dashbord';
import Login from './components/LoginPage/Login';




class App extends React.Component {


render(){
 
  return(
    <div className="">
      
      <BrowserRouter>
      <Routes>
      <Route  path="dashbord" element={<Dashbord />}></Route>
        <Route path='/' element={<Login />}></Route>

      </Routes>
      </BrowserRouter>
        
    </div>
  );
}
}

export default App;
