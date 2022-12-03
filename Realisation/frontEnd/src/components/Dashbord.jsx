import axios from "axios";
import React from "react";
import { useRef ,useEffect,useState } from "react";
function Dashbord (){

    const [Data,SetData]=useState([]);
    const EmailRef = useRef(null)
    const NomRef = useRef(null)


    useEffect(() =>{
        // console.log(e.target.value)
        const fetchData = async () => {
       let result = await axios.get("http://localhost:8000/api/formateur")
       .then(res=>{
        //    console.log(res.data)
           SetData(res.data)
       })
        }
        fetchData()
   },[])


   function handleClick(){
   console.log(Data)
   }



    return(
        <div>
             Nom<input  ref={} type="text"  /><br></br>
            Email<input type="text" /> <br></br>
             <button   onClick={handleClick}>login</button>
        </div>
    )
}

export default Dashbord;