import { Provider } from 'react-redux';
import { useRoutes } from 'react-router-dom';
import '../fake-db';
import { MatxTheme } from './components';
import { AuthProvider } from './contexts/JWTAuthContext';
import { SettingsProvider } from './contexts/SettingsContext';
import { Store } from './redux/Store';
import routes from './routes';

const App = () => {
  const content = useRoutes(routes);
  localStorage.removeItem("search_result");
  return (
    <Provider store={Store}>
      <SettingsProvider>
        <MatxTheme>
          <AuthProvider>{content}</AuthProvider>
        </MatxTheme>
      </SettingsProvider>
    </Provider>
  );
};

export default App;