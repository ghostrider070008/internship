import React, { Component } from 'react'

class SignIn extends Component {
    render () {
        return (

            <div class="block">
                <h1>Это наш интернет магазин</h1>
                <button><a href="https://internship/auth/signup">рега</a></button>
                <button><a href="https://internship/api">Дайка мне  всех юзеров</a></button>
                <button><a href="https://internship/api/view?id=5">Дайка мне конкретного юзера</a></button>
                <p>Самое важное и сложное. Даже не стал прописывать этой кнопки атрибуты, т.к сюда будет пробрасываться компонент. Ну можете пока почудить с кнопкой..</p>
            </div>
        )
    }
}

export default SignIn