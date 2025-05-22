import { Inertia } from "@inertiajs/react";
import Global from "./global";

const HandleSetFormType = (type) => {
    switch (type) {
        case "agendamento":
            Global.formType = "agendamento";
            break;
        case "login":
            Global.formType = "login";
            break;
        case "cadSolicitante":
            Global.formType = "cadSolicitante";
            break;
        case "solicitacao":
            Global.formType = "solicitacao";
            break;
        case "entrega":
            Global.formType = "entrega";
            break;
        default:
            throw new Error("tipo de form não existente");
            break;
    }
};

const HandleGetFormType = () => {
    return Global.formType;
};

const HandleLogin = (email, senha, navigate, setError) => {
    Inertia.post(
        "/login", // rota do backend pra lidar com o login
        { email, senha }, // dados enviados que vão ser email e senha
        {
            onSuccess: (response) => {
                // login foi bem-sucedido
                console.log(
                    "Login bem-sucedido! Beneficiários:",
                    response.props.beneficiarios
                );
                navigate("/dashboard"); // redirecionando pro dashboard
            },
            onError: (errors) => {
                // Se login falhou, exibir o erro retornado pelo back
                setError(
                    errors.email || "Credenciais inválidas. Tente novamente."
                );
            },
        }
    );
};

export { HandleSetFormType, HandleGetFormType, HandleLogin };
