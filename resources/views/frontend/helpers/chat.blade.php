<style>
 
::-webkit-scrollbar {
    width: 4px;
    opacity: 0;

}

::-webkit-scrollbar-thumb {
	background: #9fa2a9;
	//border-radius: 5px;
    visibility: hidden;
    
}

::-webkit-scrollbar-thumb:hover {
	background-color: darken(#9fa2a9, 10%);
}
::-webkit-scrollbar-thumb:active {
	background-color: darken(#9fa2a9, 20%);
}

*:hover::-webkit-scrollbar-thumb {
    visibility: visible;
}

.tabs-container-chat {
    /*position: fixed;
    bottom: 0; 
    right: 0;*/
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.chat-tab, .chat-header {
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
}

.chat-tab {
    width: 30rem;
    margin: 0 .5rem;
    box-shadow: 0 1px 4px rgba(28, 30, 33, 0.3);
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.chat-header {
    display: grid;
    grid-template-columns: auto 120px 1fr;
    grid-template-rows: repeat(2, auto);
    grid-column-gap: .65rem;
    justify-content: left;
    align-items: center;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
    padding: .5rem;
    cursor: pointer;
    z-index: 2;
}
.chat-tab, .chat-header {
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
}
.chat-header, .chat-body, .chat-footer {
    background-color: #fff;
}
.user-avatar {
    width: 1.75rem;
    height: 1.75rem;
    grid-row: span 2;
    position: relative;
    border-radius: 50%;
    background-image: url(https://raw.githubusercontent.com/darrelmasis/fb-chat-tab/master/img/avatar.png);
}
.user-avatar--main:after {
    content: '';
    width: .6rem;
    height: .6rem;
    background-color: #42b72a;
    border: 2px solid #fff;
    position: absolute;
    bottom: 0;
    right: 0;
    border-radius: 50%;
}
.user-name {
    margin-left: 10px;
    margin-top: 2px;
    color: #1c1e21;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.user-state {
    grid-column: 2;
    grid-row: 2;
    font-size: 12px;
    font-weight: 500;
    color: #9fa2a9;
    cursor: default;
}
.chat-options {
    display: flex;
    grid-row: span 2;
    justify-content: space-between;
    align-items: center;
}
.options-header .icon:nth-child(1) {
    background-position: 0 -216px;
}
.icon {
    width: 1rem;
    height: 1rem;
    background-color: #f1f0f0;
    cursor: pointer;
    background: url(https://raw.githubusercontent.com/darrelmasis/fb-chat-tab/master/img/dAgGoyMhmXa.png);
}

.chat-body {
    position: relative;
}
.chat-header, .chat-body, .chat-footer {
    background-color: #fff;
}
.chat-body::before {
    content: '';
     position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 70%;
    z-index: 1;
    pointer-events: none;
}
.chat-container {
    height: 30rem;
    overflow-y: auto;
    overflow-x: hidden; 
    padding: .5rem;
    font-size: 0.8125em;
    margin-right: .5rem;
}
.chat {
    display: flex;
    align-items: center;
    margin: .5rem 0;
}
.chat .user-avatar {
    margin-right: .5rem;
}
.user-avatar {
    width: 1.75rem;
    height: 1.75rem;
    grid-row: span 2;
    position: relative;
    border-radius: 50%;
    background-image: url(/images/customer-default.jpg);
}
.chat-text {
    background-color: #f1f0f0;
	padding: 5px 10px 5px 10px;    
	border-radius: 1rem;
    max-width: 70%;
}
.chat-user > .chat-text {
    background-color: #19b453;
    color: #fff;
}
.chat-user {
    justify-content: flex-end;
}
.chat-footer {
    padding: .5rem;
    border-top: 1px solid #e5e5e5;
}

.message-form textarea {
    min-width: auto;
    height: auto;
}
.message {
    width: 100% !important;
    resize: none;
    border: none;
    font-family: inherit;
    line-height: 1.5;
    max-height: 6.25rem;
    outline: 0;
    overflow-y: auto;
    padding: 0 .5rem 0 0;
    background-color: transparent;
}
.btn-message {
    
    align-items: center;
    display: inline-flex;
    justify-content: center;
    outline: none;
    position: relative;
    z-index: 0;
    -webkit-font-smoothing: antialiased;
    font-family: 'Google Sans', Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
    font-size: 15px;
    letter-spacing: .25px;
    background: none;
    border-radius: 4px;
    box-sizing: border-box;
    color: #5f6368;
    cursor: pointer;
    font-weight: 500; 
    min-width: 65px;
    outline: none; 
    background-color: #19b453;
    color: #fff;
    border: none;

}
.chat-options {
    display: flex;
    grid-row: span 2;
    justify-content: space-between;
    align-items: center;
}
.options-footer .icon:nth-child(1) {
    background-position: -68px -522px;
}
.message-form input {
	min-height: 18px !important;
	width: 100% !important; 
	height: 35px !important;
 }
</style>