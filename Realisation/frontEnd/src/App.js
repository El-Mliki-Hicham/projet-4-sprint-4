import logo from './logo.svg';
import './App.css';

import React from 'react';
import {BrowserRouter,Routes,Route} from 'react-router-dom';
import Dashbord from './components/Dashbord';


class App extends React.Component {


render(){
 
  return(
    <div className="">
      

      <BrowserRouter>
      <Routes>
        <Route path='/' element={<Dashbord />}></Route>
    
      </Routes>
      </BrowserRouter>
    </div>
  );
}
}

export default App;
