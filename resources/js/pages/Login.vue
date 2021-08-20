<style scoped>
    /*
    * Prefixed by https://autoprefixer.github.io
    * PostCSS: v8.3.6,
    * Autoprefixer: v10.3.1
    * Browsers: last 4 version
    */

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    * {
        outline: none;
    }

    .error {
        border: 1px solid #EB1F12;
    }

    .invalid-feedback {
        color: #EB1F12;
        margin-top: .6rem;
        margin-bottom: 1.4rem;
    }

    .main-container {
        /* margin: 0;
        padding: 0; */
        min-height: 100vh;
        overflow: hidden;
        position: relative;
        background-color: #ffffff;
        font-family: 'Roboto', sans-serif;
        color: #32507A;
    }

    a {
        text-decoration: none;
        color: #277FFE;
    }

    main {
        width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
    }

    h1.login-form__title {
        margin: 0 auto;
        text-align: center;
    }

    form.login-form__form {
        margin-top: 2.4rem;
    }

    .login-form__field-wrapper {
        margin-bottom: 1.4rem;
    }

    .login-form__input-wrapper {
        margin: .4rem auto;
        padding: .8rem 1.2rem;
        border-radius: 5px;
        -webkit-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    label.login-form__label {
        color: #8490A7;
        font-weight: 500;
        margin-bottom: 0;
    }

    .login-form__input-wrapper > svg {
        color: #277FFE;
    }

    input.login-form__input {
        display: inline-block;
        width: 90%;
        height: 30px;
        border: none;
        margin-left: .4rem;
        font-size: 1rem;
        color: #32507A;
    }

    input.login-form__input:focus, 
    input.login-form__input:focus-visible, 
    input.login-form__input:active {
        border: none;
        border-bottom: 1px solid #277FFE;
    }

    .login-form__submit-btn {
        width: 100%;
        margin-top: .6rem;
        padding: .8rem;
        border: none;
        background-color: #277FFE;
        color: #FFFFFF;
        border-radius: 5px;
        -webkit-transition: background-color 0.3s linear;
        -o-transition: background-color 0.3s linear;
        transition: background-color 0.3s linear;
        cursor: pointer;
    }

    .login-form__submit-btn:focus,
    .login-form__submit-btn:active,
    .login-form__submit-btn:hover {
        background-color: #0155cb;
        border: none;
    }

    p.password-reset-notice {
        margin-top: 2rem;
        text-align: center;
        color: #8490A7;
    }

    @media screen and (min-width: 768px) {
        .main-container {
            background-color: #F2F5FF;
        }

        main {
            width: max(400px, 35%);
            margin: auto;
        }

        .login-form {
            background-color: #FFFFFF;
            padding: 2rem 3rem 2rem;
            border-radius: 10px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.06) 0px 4px 12px;
                    box-shadow: rgba(0, 0, 0, 0.06) 0px 4px 12px;
        }

        p.password-reset-notice {
            margin-top: 1.4rem;
        }
    }
</style>

<template>
    <div class="main-container">
        <main>
            <div class="login-form">
                <h1 class="login-form__title">Donation Management</h1>
                <form class="login-form__form" @submit.prevent="login">
                    <div class="login-form__field-wrapper">
                        <label for="email"  class="login-form__label">Email</label>
                        <div class="login-form__input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                            </svg>
                            <input v-model="form.email" type="email" class="login-form__input" name="email" placeholder="Enter your email" autofocus required/>
                        </div>
                        <div class="invalid-feedback d-block" v-if="errors && errors.email">
                            <span>{{ errors.email[0] }}</span>
                        </div>
                    </div>
                    <div class="login-form__field-wrapper">
                        <label for="password" class="login-form__label">Password</label>
                        <div class="login-form__input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                            <input v-model="form.password" type="password" name="password" class="login-form__input" placeholder="Enter your password" required />
                        </div>
                        <div class="invalid-feedback d-block" v-if="errors && errors.password">
                            <span>{{ errors.password[0] }}</span>
                        </div>
                    </div>
                    <button type="submit" class="login-form__submit-btn">Sign In</button>
                </form>
            </div>
            <p class="password-reset-notice">Lupa password? <a href="/forgot-password">Reset Password</a></p>
        </main>
    </div>
</template>

<script>
    import store from '../store.js'
    import User from '../apis/User'

    export default {
        name: 'Login',
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                errors: {}
            }
        },
        methods: {
            login() {
                this.$Progress.start()

                User.login(this.form)
                    .then(response => {
                        store.role = response.data.user.role
                        this.$router.push({path: '/'})
                    })
                    .catch(error => {
                        this.$Progress.fail()
                        
                        if(error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    });;
            }
        },
        mounted() {
            this.$Progress.finish()
        }
    }
</script>