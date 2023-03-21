import { useEffect, useState } from "react";
import axios from 'axios';
import { useNavigate, useParams } from "react-router-dom";

const Edite = () => {
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [image, setImage] = useState('');
    const {id}=useParams()
    const navigate=useNavigate()
    const fetchProducts=async (e) => {
        await axios.post('http://127.0.0.1:8000/api/show/'+id)
        .then(({data})=>{
            console.log(data)
            setTitle(data.message.title)
            setDescription(data.message.descritpion)
        })
        .catch(({response})=>{
            console.log(response)
        })
    };
    useEffect(()=>{
        fetchProducts()
    },[])

    
    const EditeProduct = async (e) => {
        e.preventDefault();
        const formdata=new FormData()
        formdata.append('_method','PATCH')
        formdata.append('title',title)
        formdata.append('description',description)
        if(image!==null){
            formdata.append('image',image)
        }
        await axios.post('http://127.0.0.1:8000/api/update/'+id,formdata)
        .then(({data})=>{
            console.log(data)
            navigate('/table')
        })
        .catch(({response})=>{
            console.log(response)
        })
    };
    return ( 
        <form>
            <label>
                title:
                <input type="text" className="form-control " value={title} onChange={(e) => setTitle(e.target.value)} />
            </label>
            <br />
            <label>
                description:
                <input type="text" className="form-control " value={description} onChange={(e) => setDescription(e.target.value)} />
            </label>
            <br />
            <label>
                Image:
                <input type="file" className="form-control " onChange={(e)=>setImage(e.target.files[0])} />
            </label>
            <br />
            <button type="submit" className="btn btn-outline-success" onClick={EditeProduct}>update</button>
        </form>
     );
}
 
export default Edite;