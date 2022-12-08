import logo from './logo.svg';
import './App.css';

import React from 'react';
import {BrowserRouter,Routes,Route} from 'react-router-dom';
import Dashbord from './components/DashbordPage/Dashbord';
import Login from './components/LoginPage/Login';
import ChartBar from './components/DashbordPage/chart';
import ChartBar2 from './components/DashbordPage/ChartBar';



class App extends React.Component {


render(){
 
  return(
    <div className="">
      
      <BrowserRouter>
      <Routes>
        <Route path='/dashbord' element={<Dashbord />}></Route>
        <Route path='/' element={<Login />}></Route>

      </Routes>
      </BrowserRouter>
         <ChartBar/>
         {/* <ChartBar2/> */}
    </div>
  );
}
}

export default App;
