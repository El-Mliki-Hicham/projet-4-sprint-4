import logo from './logo.svg';
import "./style.css";
import { useState } from 'react';

function Title (){

  return (
    <h1> La som</h1>
  )
}


function App() {
 
  let a = 2
  let b = 2
  let result = a+b  
  
  console.log(result)
  return (
    <div className="App">
      <Title />
    <p>La som de x et y =  {result}</p>

    </div>
  );
}

export default App;
