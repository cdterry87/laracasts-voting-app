<x-modal-confirm event-to-open-modal="delete-idea-modal"
                 event-to-close-modal="ideaDelete"
                 modal-title="Delete Idea"
                 modal-description="Are you sure you want to delete this idea? This action cannot be undone."
                 modal-confirm-button-text="Delete"
                 wire-click="deleteIdea" />