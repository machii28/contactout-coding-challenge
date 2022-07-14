// @ts-ignore
import React, {Component, KeyboardEventHandler} from 'react';
// @ts-ignore
import ReactDOM from "react-dom";
import CreatableSelect from "react-select/creatable";
import axios from "axios";


const components = {
    DropdownIndicator: null
}

interface Option {
    readonly label: string;
    readonly value: string;
}

const createOption = (label: string) => ({
    label,
    value: label
})

interface State {
    readonly inputValue: string;
    value: readonly Option[];
}

export default class Referral extends Component {
    state: State = {
        inputValue: '',
        value: [],
    };

    handleKeyDown: KeyboardEventHandler<HTMLDivElement> = (event) => {
        const {inputValue, value} = this.state;

        if (!inputValue) return;

        switch (event.key) {
            case 'Enter':
            case 'Tab':
                const emailRegex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

                if (!emailRegex.test(inputValue)) return;

                this.setState({
                    inputValue: '',
                    value: [...value, createOption(inputValue)],
                });
                event.preventDefault();
        }
    };

    handleInputChange = (inputValue: string) => {
        this.setState({inputValue});
    };

    handleSubmitClick = () => {
        let emails: string[] = [];

        this.state.value.forEach((value) => {
            emails.push(value.value);
        });

        axios.post('/referrals', {
            emails: emails
        }).then((response) => {
            alert('Refferals Successfully Sent');

            window.location.href = '/';
        }).catch((error) => {
            let errorMessages = error.response.data.errors;
            let errorEmails = [];

            errorEmails = errorMessages.emails;

            errorEmails.forEach((value: any) =>  {
                alert(value);
            });
        });
    }

    render() {
        const {inputValue, value} = this.state

        return (
            <div className="card">
                <div className="card-header">Contactout Referral Program</div>
                <div className="card-body">
                    <CreatableSelect
                        isClearable
                        components={components}
                        isMulti
                        onKeyDown={this.handleKeyDown}
                        placeholder="Type something and press enter..."
                        value={value}
                        menuIsOpen={false}
                        inputValue={inputValue}
                        onInputChange={this.handleInputChange}
                    />

                    <button className="btn btn-success w-100 mt-3" onClick={this.handleSubmitClick}>Submit</button>
                </div>
            </div>
        )
    }
}


if (document.getElementById('referral-component')) {
    ReactDOM.render(<Referral/>, document.getElementById('referral-component'));
}
