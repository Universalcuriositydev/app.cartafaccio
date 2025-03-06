document.addEventListener('DOMContentLoaded', function() {
    const openArticlePopupBtn = document.getElementById('openArticlePopupBtn');
    const articlePopup = document.getElementById('articlePopup');
    const overlay = document.getElementById('overlay');
    const cancelArticleBtn = document.getElementById('cancelArticleBtn');
    const saveArticleBtn = document.getElementById('saveArticleBtn');
    const articleTitleInput = document.getElementById('articleTitle');
    const articleTextInput = document.getElementById('articleText');
    const articleList = document.getElementById('articleList');
    let currentArticleId;

    openArticlePopupBtn.addEventListener('click', () => {
        articleTitleInput.value = '';
        articleTextInput.value = '';
        saveArticleBtn.removeEventListener('click', saveArticle);
        saveArticleBtn.addEventListener('click', saveArticle);
        articlePopup.style.display = 'block';
        overlay.style.display = 'block';
    });

    cancelArticleBtn.addEventListener('click', () => {
        articlePopup.style.display = 'none';
        overlay.style.display = 'none';
    });

    function saveArticle() {
        const title = articleTitleInput.value;
        const text = articleTextInput.value;

        if (title && text) {
            const articleData = {title, text};
            console.log('Dati inviati:', articleData);

            fetch('php/insert_article.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(articleData)
            })
                .then(response => {
                    console.log('Risposta ricevuta:', response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dati ricevuti:', data); // Aggiungi questo per vedere la risposta
                    if (data.success) {
                        loadArticles();
                        articlePopup.style.display = 'none';
                        overlay.style.display = 'none';
                        articleTitleInput.value = '';
                        articleTextInput.value = '';
                    } else {
                        alert('Errore durante il salvataggio dell\'articolo: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Errore nella richiesta:', error);
                    alert('Errore nella richiesta: ' + error.message);
                });
        } else {
            alert('Per favore, inserisci tutti i campi.');
        }
    }

    function loadArticles() {
        fetch('php/get_articles.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error('Errore nel caricamento degli articoli: ' + data.error);
                }
                articleList.innerHTML = '';
                data.articles.forEach(article => {
                    const row = document.createElement('tr');
                    const titleCell = document.createElement('td');
                    const textCell = document.createElement('td');
                    const statusCell = document.createElement('td');
                    const actionCell = document.createElement('td');

                    titleCell.textContent = article.title;
                    textCell.textContent = article.text;
                    statusCell.textContent = article.status;

                    const actionMenu = document.createElement('div');
                    actionMenu.className = 'action-menu';

                    const actionButton = document.createElement('button');
                    actionButton.textContent = 'Azioni';
                    actionMenu.appendChild(actionButton);

                    const actionMenuContent = document.createElement('div');
                    actionMenuContent.className = 'action-menu-content';

                    const deleteAction = document.createElement('a');
                    deleteAction.href = '#';
                    deleteAction.textContent = 'Elimina';
                    deleteAction.addEventListener('click', () => deleteArticle(article.id));
                    actionMenuContent.appendChild(deleteAction);

                    const editAction = document.createElement('a');
                    editAction.href = '#';
                    editAction.textContent = 'Modifica';
                    editAction.addEventListener('click', () => editArticle(article.id, article.title, article.text));
                    actionMenuContent.appendChild(editAction);

                    if (article.status === 'bozza') {
                        const publishAction = document.createElement('a');
                        publishAction.href = '#';
                        publishAction.textContent = 'Pubblica';
                        publishAction.addEventListener('click', () => publishArticle(article.id));
                        actionMenuContent.appendChild(publishAction);
                    } else if (article.status === 'pubblicato') {
                        const unpublishAction = document.createElement('a');
                        unpublishAction.href = '#';
                        unpublishAction.textContent = 'Ritira';
                        unpublishAction.addEventListener('click', () => unpublishArticle(article.id));
                        actionMenuContent.appendChild(unpublishAction);
                    }

                    actionMenu.appendChild(actionMenuContent);
                    actionCell.appendChild(actionMenu);

                    row.appendChild(titleCell);
                    row.appendChild(textCell);
                    row.appendChild(statusCell);
                    row.appendChild(actionCell);

                    articleList.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Errore nel caricamento degli articoli:', error);
                alert('Errore nel caricamento degli articoli: ' + error.message);
            });
    }

    function unpublishArticle(id) {
        fetch('php/unpublish_article.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadArticles();
                } else {
                    alert('Errore durante il ritiro dell\'articolo: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Errore nella richiesta:', error);
                alert('Errore nella richiesta: ' + error.message);
            });
    }


    function deleteArticle(id) {
        fetch('php/delete_article.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadArticles();
                } else {
                    alert('Errore durante l\'eliminazione dell\'articolo: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Errore nella richiesta:', error);
                alert('Errore nella richiesta: ' + error.message);
            });
    }

    function editArticle(id, title, text) {
        articleTitleInput.value = title;
        articleTextInput.value = text;
        saveArticleBtn.removeEventListener('click', saveArticle);
        saveArticleBtn.addEventListener('click', function() {
            const updatedTitle = articleTitleInput.value;
            const updatedText = articleTextInput.value;

            fetch('php/update_article.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, title: updatedTitle, text: updatedText })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadArticles();
                        articlePopup.style.display = 'none';
                        overlay.style.display = 'none';
                        articleTitleInput.value = '';
                        articleTextInput.value = '';
                    } else {
                        alert('Errore durante la modifica dell\'articolo: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Errore nella richiesta:', error);
                    alert('Errore nella richiesta: ' + error.message);
                });
        });
        articlePopup.style.display = 'block';
        overlay.style.display = 'block';
    }

    function publishArticle(id) {
        fetch('php/publish_article.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadArticles();
                } else {
                    alert('Errore durante la pubblicazione dell\'articolo: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Errore nella richiesta:', error);
                alert('Errore nella richiesta: ' + error.message);
            });
    }

    loadArticles();
});