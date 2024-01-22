import { Box } from '@mui/material';
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import useMediaQuery from '@mui/material/useMediaQuery';
import { useTheme } from '@mui/system';
import React from 'react';

export default function ResponsiveDialog() {
  const [open, setOpen] = React.useState(false);
  const theme = useTheme();
  const fullScreen = useMediaQuery(theme.breakpoints.down('sm'));

  function popupClickOpen() {
    setOpen(true);
  }

  function popupClose() {
    setOpen(false);
  }

  return (
    <Box>
      <Button variant="outlined" color="primary" onClick={popupClickOpen}>
        Open responsive dialog
      </Button>

      <Dialog
        fullScreen={fullScreen}
        open={open}
        onClose={popupClose}
        aria-labelledby="responsive-dialog-title"
      >
        <DialogTitle id="responsive-dialog-title">Use Google's location service?</DialogTitle>

        <DialogContent>
          <DialogContentText>
            Let Google help apps determine location. This means sending anonymous location data to
            Google, even when no apps are running.
          </DialogContentText>
        </DialogContent>

        <DialogActions>
          <Button onClick={popupClose} color="primary">
            Disagree
          </Button>

          <Button onClick={popupClose} color="primary" autoFocus>
            Agree
          </Button>
        </DialogActions>
      </Dialog>
    </Box>
  );
}
