import axios from "axios";

import Cookies from "universal-cookie";


import React from "react";
import { useRef ,useEffect,useState } from "react";
import {useNavigate} from 'react-router-dom';
function Login (){

    const cookies = new Cookies();

    const navigate = useNavigate();
    const [Data,SetData]=useState([]);
    const [Email,SetEmail]=useState();
    const [Nom,SetNom]=useState();
    const [Message,SetMessage]=useState();
    const EmailRef = useRef(null)
    const NomRef = useRef(null)


    useEffect(() =>{
        console.log(cookies.get('FormateurID'));
        // console.log(e.target.value)
        const fetchData = async () => {
       await axios.get("http://localhost:8000/api/formateur")
       .then(res=>{
           console.log(res.data)
           SetData(res.data)
       })
        }
        fetchData()
   },[])


   function handleClick(){
   console.log(Email,Nom)

    Data.map(value=>{
    if(Email==value.Email_formateur && Nom ==value.Nom_formateur){


       cookies.set('FormateurID', value.id)
       
       console.log(cookies.get('FormateurID'));
    
        navigate('/dashbord')
    }

    else{
        SetMessage('Name or Email is not correct')
    }
})
   }
   function HandleChange(e){
        SetEmail(EmailRef.current.value)
        SetNom(NomRef.current.value)
   }



    return(
        <div>
             Nom<input  onChange={HandleChange}  id="name" ref={NomRef} type="text"  /><br></br>
            Email<input  onChange={HandleChange}   id="name" ref={EmailRef} type="text" /> <br></br>
             <button   onClick={handleClick}>login</button>
             {Message}
        </div>
    )
}

export default Login;