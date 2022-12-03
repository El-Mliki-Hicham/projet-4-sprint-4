import React from "react";
import Cookies from "universal-cookie";
import { useEffect } from "react";
import axios from "axios";
function Dashbord() {
    const cookies = new Cookies();

    useEffect(() => {
        axios.get()
        console.log(cookies.get('FormateurID'));        
    }, []);
}
export default Dashbord;