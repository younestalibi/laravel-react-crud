import logo from './logo.svg';
import './App.css';
import axios from 'axios';

import 'bootstrap/dist/css/bootstrap.min.css'
import { BrowserRouter as Router,Route,Routes } from 'react-router-dom';
import { Link } from 'react-router-dom';
import Table from './pages/Table';
import Form from './pages/Form';
import Edite from './pages/Edite';

function App() {

  // const createProduct = async (productData) => {
  //   try {
  //     const response = await axios.get('http://127.0.0.1:8000/api/notes');
  //     console.log(response.data);
  //     // alert('hi')
  //   } catch (error) {
  //     console.error(error);
  //     // alert('err')
  //   }
  // };
  // createProduct()

  return (
    <div className="App">
      <Router>
      <nav className="navbar navbar-light bg-light mb-5">
        <span className="navbar-brand mb-0 h1 mx-4">Store</span>
        <ul className="navbar-nav mr-auto d-flex flex-row">
          <li className="nav-item active">
            <Link className="nav-link mx-4" to="/">Form</Link>
          </li>
          
          <li className="nav-item active">
            <Link to="/table" className="nav-link mx-4">Table</Link>
          </li>
        </ul>
      </nav>
      <Routes>
        <Route exact path="/" element={<Form/>} />
        <Route exact path="/edite/:id" element={<Edite/>} />
        <Route exact path="/table" element={<Table/>} />
      </Routes>
    </Router>
    </div>
  );
}

export default App;
