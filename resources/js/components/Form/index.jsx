import { useState } from "react";
import { useNavigate } from "react-router-dom";
import styles from "./styles.module.css";
import { HandleLogin } from "../../manager";

function LoginForm() {
    const [ajuda, setAjuda] = useState(false); // 
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const [error, setError] = useState("");
    const navigate = useNavigate();

    const HandleChangeEmail = (event) => {
        setEmail(event.target.value);
    };

    const HandleChangeSenha = (event) => {
        setSenha(event.target.value);
    };

    const handleSubmit = () => {
        if (!email || !senha) {
            setError("Por favor, preencha email e senha.");
            return;
        }
        setError("");
        HandleLogin(email, senha, navigate, setError); // Passar o setError
    };

    return (
        <div className={styles.Container}>
            {!ajuda ? (
                <div className={styles.content}>
                    <h1>Login</h1>
                    <h6>Bem-Vindo de volta</h6>
                    <div className={styles.line} />
                    {error && <p style={{ color: "red" }}>{error}</p>}
                    <input
                        type="email"
                        name="Email"
                        value={email}
                        onChange={HandleChangeEmail}
                        placeholder="Email"
                    />
                    <input
                        type="password"
                        name="Senha"
                        value={senha}
                        onChange={HandleChangeSenha}
                        placeholder="Senha"
                    />
                    <input
                        type="button"
                        onClick={handleSubmit}
                        value="Conecte-se"
                    />
                </div>
            ) : (
                <div className={styles.content}>
                    <h1>Login</h1>
                    <div className={styles.line} />
                    <p>
                        Se você é um Assistente Social cadastrado, faça login
                        com seu email e senha.
                    </p>
                </div>
            )}
            <h2
                onClick={() => {
                    setAjuda(!ajuda);
                }}
            >
                Precisa de ajuda?
            </h2>
        </div>
    );
}

export default LoginForm;