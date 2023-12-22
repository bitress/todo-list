import Login from "../components/Auth/Login.jsx";

function LoginPage({setLoggedIn}) {
    return (
        <>
          <Login setLoggedIn={setLoggedIn}></Login>
        </>
    );
}

export default LoginPage;
