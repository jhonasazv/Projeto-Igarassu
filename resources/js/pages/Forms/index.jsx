import { useEffect, useState } from "react";
import { HandleGetFormType } from "../../manager";
import Header from "../../components/Header";
import Form from "../../components/Form";

export default function Forms() {
    useEffect(() => {
        console.log("Componente montado!");

        return () => {
            console.log("Componente desmontado!");
        };
    }, []);
    const formType = HandleGetFormType();

    const [type, setType] = useState(String(HandleGetFormType()));
    return (
        <div>
            <Header type={"off"} />
            <Form type={formType} />
        </div>
    );
}
