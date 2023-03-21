import { useState } from "react";
import axios from 'axios';
import { useNavigate } from "react-router-dom";

const Form = () => {
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [image, setImage] = useState('');
    const navigate=useNavigate()
    const createProduct = async (e) => {
        e.preventDefault();
        const formdata=new FormData()
        formdata.append('title',title)
        formdata.append('description',description)
        formdata.append('image',image)
        await axios.post('http://127.0.0.1:8000/api/create',formdata)
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
            <button type="submit" className="btn btn-outline-success" onClick={createProduct}>Create</button>
        </form>
     );
}
 
export default Form;