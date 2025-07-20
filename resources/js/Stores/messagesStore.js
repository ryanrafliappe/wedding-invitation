import { defineStore } from "pinia";
import { ref } from "vue";

export const useMessagesStore = defineStore('messages', () => {
    const messages = ref([])

    const setMessages = (newMessages) => {
        messages.value = newMessages
    }

    const addMessage = newMessage => {
        messages.value.unshift(newMessage)
    }

    const fetchMessages = async () => {
        try {
            const res = await fetch('/api/messages');
            if (!res.ok) throw new Error('Gagal memuat pesan');
            const data = await res.json();
            setMessages(data);
        } catch (error) {
            console.error('Error saat fetch: ', error);
        }
    }

    const clearMessages = () => {
        messages.value = []
    }

    return { messages, setMessages, addMessage, clearMessages, fetchMessages }
})