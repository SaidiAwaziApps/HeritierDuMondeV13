import axios from "axios";

import useMessageStore from "../../../../store/contact/message";

class UpdateMessageService {
    constructor(refComponent) {
        this.refComponent = refComponent;
    }

    async setAuthReadedGroupMessage(readed) {
        // Serial Code
        const auth_serial_code = this.refComponent.messages[this.refComponent.messages.length - 1].auth_serial_code;

        // Appel a l' API (modifie la methion readed (lecture) de l' ensemble de groupe de message destinee a un destinateur)
        await axios.put('/message/set-auth-readed-group-messages/'+auth_serial_code, {
            readed
        })
        .then((response) => {
            // Store (message)
            const store = useMessageStore();
            // Message avec readed modifie (true or false)
            const messages = store.items.map(item => {
                if(item.auth_serial_code == auth_serial_code) {
                    item.readed = response.data.messages[0].readed;
                }
                return item;
            });
            // Modifie le state
            store.setItems(messages);
            // console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
    }
}

export default UpdateMessageService;