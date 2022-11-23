import logo from './logo.svg';
import './App.css';

import React from 'react';
import BriefTable from './components/brief-table';
import {BrowserRouter,Routes,Route} from 'react-router-dom';
import ConsulterBrief from './components/consulter_brief';
import ConsulterTache from './components/consulter_tache';
import ConsulterStudent from './components/consulter_student';


class App extends React.Component {


render(){
 
  return(
    <div className="">
      

      <BrowserRouter>
      <Routes>
        <Route path='/' element={<BriefTable/>}></Route>
        <Route path='consulter/:briefId' element={<ConsulterBrief/>}></Route>
        <Route path='consulterTache/:briefId' element={<ConsulterTache/>}></Route>
        <Route path='consulterStudent/:briefId' element={<ConsulterStudent />}></Route>
      </Routes>
      </BrowserRouter>
    </div>
  );
}
}

export default App;
