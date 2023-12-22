import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import {faPencil, faTrash} from '@fortawesome/free-solid-svg-icons'

const TodoList = () => {
    return (
        <div className="container mt-5">
            <h2 className="text-center mb-4">To-do List</h2>
            <ul className="list-group">
                <li className="list-group-item d-flex justify-content-between align-items-center">
                    Task 1
                    <span className="badge bg-primary">In Progress</span>
                    <div className="btn-group" role="group">
                        <button type="button" className="btn btn-outline-warning"><FontAwesomeIcon icon={faPencil}/></button>
                        <button type="button" className="btn btn-outline-danger"><FontAwesomeIcon icon={faTrash}/></button>
                    </div>
                </li>
                <li className="list-group-item d-flex justify-content-between align-items-center">
                    Task 2
                    <span className="badge bg-success">Completed</span>
                    <div className="btn-group" role="group">
                        <button type="button" className="btn btn-outline-warning"><FontAwesomeIcon icon={faPencil} /></button>
                        <button type="button" className="btn btn-outline-danger"><FontAwesomeIcon icon={faTrash} /></button>
                    </div>
                </li>
            </ul>
            <div className="mt-3 text-center">
                <button type="button" className="btn btn-success">Add Task</button>
            </div>
        </div>
    );
}

export default TodoList;
